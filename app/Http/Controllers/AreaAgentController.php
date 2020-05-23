<?php

namespace App\Http\Controllers;

use App\AreaAgentLevelModel;
use App\Http\Requests\AreaAgentLevelRequest;
use App\Http\Resources\AreaAgentResource;
use Illuminate\Http\Request;

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

    public function AreaAgentEdit(AreaAgentLevelRequest $agentLevelRequest)
    {
        $model = $this->areaAgentLevelModel::query()->create($agentLevelRequest->post());

        return new AreaAgentResource($model);
    }
}
