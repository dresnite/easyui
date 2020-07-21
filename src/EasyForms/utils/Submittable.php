<?php
/*
 * Copyright (C) GiantQuartz - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

declare(strict_types=1);


namespace EasyForms\utils;


trait Submittable {
    use SubmitListener;

    public function onSubmit(): void {
        $this->executeSubmitListener();
    }

}