<?php

namespace App\Http\Controllers\Excel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Bnb;
use App\Models\Hoster;
use Illuminate\Support\Facades\Log;

class ExcelController extends Controller {

    private function setExcelName() {
        return date('Y-m-d H:i:s', time()) . '_repeat';
    }

    private function export($cellData, $name) {
        Log::info('用户'.$this->logUser->id.'导出数据'.$name);
        Excel::create($name, function($excel) use ($cellData) {
            $excel->sheet('score', function($sheet) use ($cellData) {
                $sheet->rows($cellData);
            });
        })->store('xls');
    }

    public function implode() {
        return view('hostel.implode');
    }

    public function implodeBnb(Request $request) {
        $file = $request->file('file');
        if (!$file->isValid()) {
            return Redirect::back()->withInput()->withErrors('文件上传出错')->with('delete', 'delete');
        }

        $extension = $file->getClientOriginalExtension();
        $extension_arr = Config::get('system.extension');
        if (!in_array($extension, $extension_arr)) {
            return Redirect::back()->withInput()->withErrors('文件上传出错')->with('delete', 'delete');
        }

        $newFileName = md5(time() . rand(0, 10000)) . '.' . $file->getClientOriginalExtension();
        $savePath = 'excel/' . $newFileName;
        $bytes = Storage::put(
                        $savePath, file_get_contents($file->getRealPath())
        );
        if (!Storage::exists($savePath)) {
            return Redirect::back()->withInput()->withErrors('保存文件失败')->with('delete', 'delete');
        }
        # 获取数据
        $filePath = 'storage/app/' . $savePath;
        if (Storage::exists($savePath)) {
            Excel::load($filePath, function($reader) {
                $workbookTitle = $reader->all();
                $name = $workbookTitle->getTitle();
                $results = $reader->toArray();

                DB::beginTransaction();
                try {
                    $arr = $this->handlerBnbExcelData($results, $name);
                    # 添加数据
                    if (!empty($arr['relation'])) {
                        DB::table('bnb_hoster')->insert($arr['relation']);
                    }
                    DB::commit();
                    # 导出重复数据至excel
                    if (!empty($arr['repeat'])) {
                        $repeat = $this->setExportExcelHeader($arr['repeat']);
                        $name = $this->setExcelName();
                        $this->export($repeat, $name);
                        return redirect('/bnb')->with('message', '民宿内容导入成功')->with('download', $name);
                    }
                    return redirect('/bnb')->with('message', '民宿内容导入成功');
                } catch (Exception $e) {
                    DB::rollBack();
                    return Redirect::back()->withInput()->withErrors('民宿内容导入失败');
                }
            });
        }
        Log::info('用户'.$this->logUser->id.'导入数据'.$filePath);
        return Redirect::back()->withInput()->withErrors('民宿内容导入失败')->with('delete', 'delete');
    }

    # 设置excel表头
    private function setExportExcelHeader($repeat = array()) {
        if (!empty($repeat)) {

            # 设置表头
            $header = array(
                'id', 'contactStatus', 'website', 'name', 'address', 'phone', 'hoster_name', 'hoster_phone', 'hoster_wechat', 'manager_name'
                , 'manager_phone', 'manager_wechat', 'price', 'buildDate', 'totalRoom', 'level', 'isparentchildfit', 'onlineactivity'
                , 'offlineactivity', 'note'
            );
            array_unshift($repeat, $header);
        }

        return $repeat;
    }

    # 处理民宿excel数据 生成对应数据
    private function handlerBnbExcelData($results = array(), $name) {
        $arr = array();
        if (!empty($results)) {
            foreach ($results as $tmp) {
                $phone = trim($tmp['phone']);
                $hoster_phone = trim($tmp['hoster_phone']);
                $manager_phone = trim($tmp['manager_phone']);

                $tmp['phone'] = $phone;
                $tmp['hoster_phone'] = $hoster_phone;
                $tmp['manager_phone'] = $manager_phone;

                $bnb_count = 0;
                $hoster_count = 0;
                $manager_count = 0;
                if ($phone) {
                    $bnb_count = Bnb::where('phone', $phone)->count();
                }
                if ($hoster_phone) {
                    $hoster_count = Hoster::where('telephone', $hoster_phone)->first();
                }
                if ($manager_phone) {
                    $manager_count = Hoster::where('telephone', $manager_phone)->first();
                }

                if ($bnb_count > 0) {
                    $arr['repeat'][] = $tmp;
                } else {
                    $relation = $this->handleRelationData($tmp, $hoster_phone, $hoster_count, $manager_phone, $manager_count, $name);
                    if(!empty($relation)){
                        $arr['relation'][] = $relation;                        
                    }
                }
                unset($bnb);
            }
            unset($tmp);
        }
        return $arr;
    }

    # 获取添加的民宿与主人和管家的关系列表
    private function handleRelationData($tmp, $hoster_phone, $hoster_count, $manager_phone, $manager_count, $name) {
        $relation = array();
        $str_count = mb_strlen($name, 'utf-8');
        if ($str_count > 0) {
            $tmp['name'] = mb_substr($tmp['name'], $str_count);
        }
        $tmp['level'] = empty($tmp['level']) ? '' : $tmp['level'];
        $tmp['createTime'] = date('Y-m-d H:i:s', time());
        $tmp['updateTime'] = date('Y-m-d H:i:s', time());

        # 创建民宿
        $bnb = Bnb::create($tmp);

        if ($hoster_phone || $manager_phone) {
            $relation['bid'] = $bnb->bid;
            $relation['createTime'] = date('Y-m-d H:i:s', time());
        }

        # 查询民宿主人信息是否存在 不存在则创建
        if ($hoster_phone) {
            if ($hoster_count) {
                $relation['hid'] = $hoster_count->hid;
                $relation['role'] = '1';
            } else {
                $hoster = Hoster::create(array(
                            'name' => empty($tmp['hoster_name']) ? $tmp['name'] . rand(1, 10000) : $tmp['hoster_name'],
                            'telephone' => $tmp['hoster_phone'],
                            'weixin' => empty($tmp['hoster_wechat']) ? $tmp['name'] . rand(1, 10000) : $tmp['hoster_wechat'],
                ));
                $relation['hid'] = $hoster->hid;
                $relation['role'] = '1';
            }
        }

        # 民宿管家 存在反馈 不存在创建
        if ($manager_phone) {
            if ($manager_count) {
                $relation['hid'] = $manager_count->hid;
                $relation['role'] = '2';
            } else {
                $manager = Hoster::create(array(
                            'name' => empty($tmp['hoster_name']) ? $tmp['name'] . rand(1, 10000) : $tmp['hoster_name'],
                            'telephone' => $tmp['hoster_phone'],
                            'weixin' => empty($tmp['hoster_wechat']) ? $tmp['name'] . rand(1, 10000) : $tmp['hoster_wechat'],
                ));
                $relation['hid'] = $manager->hid;
                $relation['role'] = '2';
            }
        }
        return $relation;
    }

}
