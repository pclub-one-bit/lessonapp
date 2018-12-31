<?php
if (!function_exists('is_current_controller')) {
    /**
     * 現在のコントローラ名が、複数の名前のどれかに一致するかどうかを判別する
     *
     * @param array $names コントローラ名 (可変長引数)
     * @return bool
     */
    function is_current_controller(...$names)
    {
        $current = explode('.', Route::currentRouteName())[0];
        return in_array($current, $names, true);
    }
}

if (!function_exists('to_datetime_local')) {
    /**
     * input type="datetime-local"で表示できる型に変更する
     *
     * @param string $str 日付文字列
     * @return string
     */
    function to_datetime_local($str)
    {
        $date = new DateTime($str);
        return $date->format('Y-m-d\TH:i');
    }
}
