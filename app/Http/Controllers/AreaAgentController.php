<?php

namespace App\Http\Controllers;

use App\AreaAgentLevelModel;
use App\Http\Requests\AreaAgentLevelRequest;
use App\Http\Resources\AreaAgentResource;
use App\Rules\AreaAgentRule;
use Illuminate\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AreaAgentController extends Controller
{
    protected $areaAgentLevelModel;

    public function __construct(AreaAgentLevelModel $agentLevelModel)
    {
        $this->areaAgentLevelModel = $agentLevelModel;
    }

    public function index()
    {
        $all = $this->areaAgentLevelModel::status()->paginate(10);

        return $all;
    }

    public function AreaAgentEdit(Request $agentLevelRequest)
    {
        try{
            $some = ['required','numeric','max:100', new AreaAgentRule];
            $validate = Validator::make($agentLevelRequest->all(),[
                'name' => 'required|max:20',
                'province' => $some,
                'city' => $some,
                'district' => $some
            ],[
                'name.required' => '名称不能为空',
                'province.required' => '省代理 不能为空',
                'province.max' => '省代理 最大100位',
                'province.numeric' => '省代理 必须是数值',
                'name.max' => '名称 最多20个字',
                'city.required' => '市代理 不能为空',
                'city.numeric' => '市代理 必须是数值',
                'city.max' => '市代理 最大100位',
                'district.required' => '区代理 不能为空',
                'district.max' => '区域代理 最大100位',
                'district.numeric' => '区域代理 必须是数值',
            ]);
            if ($validate->fails())
            {
                throw new \Exception($validate->errors()->first());
            }
            $model = $this->areaAgentLevelModel->dataFilter($agentLevelRequest->post());
            throw_if(!$model->save(), \Exception::class, '数据保存失败');
            return new AreaAgentResource($model);
        }catch (\Exception $exception)
        {
            return ['msg' => $exception->getMessage()];
        }

    }

    /**
     *
     */
    public function edit()
    {
        //编辑 展示
        DB::table();
    }
}
