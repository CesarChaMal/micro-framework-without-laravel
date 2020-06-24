<?php

namespace IziDev\MiniFramework\Controllers\Api;

use IziDev\MiniFramework\Validations\Api\PostCreateClientValidation;

class PostCreateClientController extends BaseController
{
    public function __construct()
    {
        $this->validate(new PostCreateClientValidation($this->request()->all()));
    }

    public function run()
    {
        $result = $this->client()
            ->createClient(
                $this->request()->get("document"),
                $this->request()->get("full_name"),
                $this->request()->get("email"),
                $this->request()->get("phone")
            );

        return $this->response($result);
    }
}