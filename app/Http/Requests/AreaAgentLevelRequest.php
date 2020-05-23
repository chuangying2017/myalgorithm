<?php

namespace App\Http\Requests;

class AreaAgentLevelRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $some = $this->some;

        $data = [
            'name' => 'required|max:20|unique:\App\AreaAgentLevelModel',
        ];
        $data = array_merge($data , $this->some($some, $this->field));
        return $data;
    }
    private $some = 'nullable|required|numeric|max:6';

    private $field = [
        'province','city','district'
    ];

    public function messages()
    {
        $data = [
            'name.required' => ':attribute 不能为空',
            'name.unique' => ':attribute 已存在相同名称',
            'name.max' => ':attribute 最多20个字数',
        ];
        $res = $this->some([
            'required',
            'numeric',
            'max'
        ],$this->field, [
            ':attribute 不能为空',
            ':attribute 不能为数值',
            ':attribute 最大为6位数'
        ]);
        $data = array_merge($data, $res);
        return $data;
    }

    private function some($array,array $correspondingFiled,$msg = [])
    {
        $arr = [];

        foreach ($correspondingFiled as $field)
        {
            if (is_array($array))
            {
                foreach ($array as $k => $ruleField) {
                    $arr[$field.'.'.$ruleField] = $msg[$k];
                }
            }else{
                $arr[$field] = $array;
            }
        }

        return $arr;
    }
}
