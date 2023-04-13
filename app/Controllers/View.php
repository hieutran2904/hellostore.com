<?php
    class View {
        public function loadContent($directory,$page_name) {
            include('resource/views/'.$directory.'/'.$page_name.'.php');
        }
    }
?>