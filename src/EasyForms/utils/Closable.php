<?php
/*
 * Copyright (C) GiantQuartz - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

declare(strict_types=1);


namespace EasyForms\utils;


trait Closable {
    use CloseListener;

    public function onClose(): void {
        $this->executeCloseListener();
    }

}