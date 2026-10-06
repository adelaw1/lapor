<?php

namespace App\Http\Controllers\MyLibs;

class Form
{
    private $size_label;
    private $size_input;
    private $errors;
    private $link;

    public function set_size($label, $input)
    {
        $this->size_label = $label;
        $this->size_input = $input;
    }

    public function frm_open($action, $file = false, $method = "POST")
    {
        $this->link = "/" . explode("/", $action)[1];
        $return = '<form action="' . $action . '" method="' . $method . '" ';
        if ($file) {
            $return .= 'enctype="multipart/form-data"';
        }
        $return .= ' autocomplete="off">';

        return $return;
    }

    public function frm_close()
    {
        return '</form>';
    }

    public function btn_save($back = true)
    {
        $return = '<hr /><div class="form-group row"><div class="col-12 text-right m-3"><div class="btn-group">';
        if ($back) {
            $return .= '<a href="' . $this->link . '" class="btn btn-warning btn-sm"><i class="bi bi-skip-backward"></i> Kembali</a>';
        }
        $return .= '<button type="submit" class="btn btn-sm btn-primary">Simpan <i class="bi bi-save"></i></button></div></div></div>';
        return $return;
    }

    public function btn_update($back = true)
    {
        $return = '<hr /><div class="form-group row"><div class="col-12 text-right m-3"><div class="btn-group">';
        if ($back) {
            $return .= '<a href="' . $this->link . '" class="btn btn-warning btn-sm"><i class="bi bi-skip-backward"></i> Kembali</a>';
        }
        $return .=  '<button type="submit" class="btn btn-sm btn-info">Update <i class="bi bi-arrow-clockwise"></i></button></div></div></div>';
        return $return;
    }

    public function frm_text($name, $icon = "", $value = "", $attr = [])
    {
        return $this->description("text", $name, $icon, $value, "", false, $attr);
    }

    public function frm_file($name, $icon = "", $value = "", $attr = [])
    {
        return $this->description("file", $name, $icon, $value, "", false, $attr);
    }

    public function frm_tanggal($name, $icon = "", $value = "", $attr = [])
    {
        return $this->description("tanggal", $name, $icon, $value, "", false, $attr);
    }

    public function frm_password($name, $icon = "", $value = "", $attr = [])
    {
        return $this->description("password", $name, $icon, $value, "", false, $attr);
    }

    public function frm_number($name, $icon = "", $value = "", $attr = [])
    {
        return $this->description("number", $name, $icon, $value, "", false, $attr);
    }

    public function frm_textarea($name, $icon = "", $value = "", $attr = [])
    {
        return $this->description("textarea", $name, $icon, $value, "", false, $attr);
    }

    public function frm_select($name, $icon = "", $listData = [], $value = "", $attr = [])
    {
        return $this->description("select", $name, $icon, $value, $listData, false, $attr);
    }

    public function frm_mlselect($name, $icon = "", $listData = [], $value = [], $attr = [])
    {
        return $this->description("select", $name, $icon, $value, $listData, true, $attr);
    }

    public function frm_checkbox($name, $listData, $value = "", $attr = [])
    {
        return $this->description("checkbox", $name, "", $value, $listData, false, $attr);
    }

    public function frm_checkbox_l($name, $listData, $value = "", $attr = [])
    {
        return $this->description("checkbox", $name, "", $value, $listData, true, $attr);
    }

    public function frm_radio($name, $listData, $value = "", $attr = [])
    {
        return $this->description("radio", $name, "", $value, $listData, false, $attr);
    }

    public function frm_radio_l($name, $listData, $value = "", $attr = [])
    {
        return $this->description("radio", $name, "", $value, $listData, true, $attr);
    }

    public function image($name, $attr = []) {
        return $this->description("image", $name, "", "", "", "", $attr);
    }

    private function description($type, $name, $icon = "", $value = "", $listData = "", $multiline = false, $attr = [])
    {
        $label = ucwords(str_replace("_", " ", $name));
        $return = '<div class="row mb-3">
                    <label class="control-label col-md-' . $this->size_label . '" for="' . $name . '">' . $label . '</label>
                    <div class="col-md-' . $this->size_input . '">';
        $return .= ($icon ? '<div class="input-group">' : '');

        // Initialisasi input
        if ($type == "select") {
            $initial_input = $this->initial_select($name, $listData, $value, $multiline, $attr);
        } elseif ($type == "checkbox") {
            $initial_input = $this->initial_checkbox($name, $listData, $value, $multiline, $attr);
        } elseif ($type == "radio") {
            $initial_input = $this->initial_radio($name, $listData, $value, $multiline, $attr);
        } elseif ($type == "textarea") {
            $initial_input = $this->initial_textarea($name, $value, $attr);
        } elseif ($type == "image") {
            $initial_input = $this->initial_image($name, $attr);
        } else {
            $initial_input = $this->initial_global($type, $name, $value, $attr);
        }

        if ($icon) {
            $icon = explode("|", $icon);
            $posisi = end($icon);
            $div_icon = '<span class="input-group-text">
                            <i class="bi bi-' . $icon[0] . '"></i>
                        </span>';
            $return .= ($posisi == "kanan") ? $initial_input . $div_icon : $div_icon . $initial_input;
        } else {
            $return .= $initial_input;
        }


        $return .= ($icon ? '</div>' : '');
        if ($this->errors) {
            if ($this->errors->first($name)) {
                $return .= '<span class="badge bg-danger">' . $this->errors->first($name) . '</span>';
            }
        }
        $return .= '</div>
                </div>';

        return $return;
    }

    private function initial_select($name, $listData = [], $value = "", $multiline = false, $attr = [])
    {
        $return = '<select name="' . ($multiline ? $name . '[]' : $name) . '" id="' . $name . '" ' . ($multiline ? 'multiple="multiple"' : '') . ' class="form-control select2"';
        if ($attr) {
            foreach ($attr as $k => $v) {
                $return .= $k . '="' . $v . '" ';
            }
        }
        $return .= ">";
        $return .= ($multiline ? '' : '<option value="">- Pilih ' . ucwords(str_replace("_", " ", $name)) . ' -</option>');
        if ($listData) {
            foreach ($listData as $key => $val) {
                if ($multiline) {
                    $value = ($value ? $value : []);
                    $slt = (array_search($key, $value) === false) ? "" : "selected";
                } else {
                    $slt = ($value == $key) ? "selected" : "";
                }

                $return .= '<option value="' . $key . '" ' . $slt . '>' . $val . '</option>';
            }
        }
        $return .= "</select>";

        return $return;
    }

    private function initial_checkbox($name, $listData, $value = "", $multiline = false, $attr = [])
    {
        $return = "<div>";
        foreach ($listData as $key => $val) {
            $value = ($value ? $value : []);
            $ck = (array_search($key, $value) === false) ? "" : "checked";
            $return .= ($multiline ? '<div class="form-check">' : '<div class="form-check form-check-inline">');
            $return .= '<input type="checkbox" class="form-check-input" id="' . $key . '" name="' . $name . '[]" value="' . $key . '" ' . $ck . ' ';
            if ($attr) {
                foreach ($attr as $k => $v) {
                    $return .= $k . '="' . $v . '" ';
                }
            }
            $return .= ' /><label class="form-check-label" for="' . $key . '">' . $val . '</label>';
            $return .= '</div>';
        }

        $return .= "</div>";

        return $return;
    }

    private function initial_radio($name, $listData, $value = "", $multiline = false, $attr = [])
    {
        $return = "<div>";
        foreach ($listData as $key => $val) {
            $ck = ($key == $value) ? "checked" : "";
            $return .= ($multiline ? '<div class="form-check">' : '<div class="form-check form-check-inline">');
            $return .= '<input type="radio" class="form-check-input" id="' . $key . '" name="' . $name . '" value="' . $key . '" ' . $ck . ' ';
            if ($attr) {
                foreach ($attr as $k => $v) {
                    $return .= $k . '="' . $v . '" ';
                }
            }
            $return .= ' /><label class="form-check-label" for="' . $key . '">' . $val . '</label>';
            $return .= '</div>';
        }
        $return .= "</div>";

        return $return;
    }

    private function initial_textarea($name, $value = "", $attr = [])
    {
        $return = '<textarea name="' . $name . '" id="' . $name . '" class="form-control" ';
        if ($attr) {
            foreach ($attr as $k => $v) {
                $return .= $k . '="' . $v . '" ';
            }
        }
        $return .= '>' . $value . '</textarea>';

        return $return;
    }

    private function initial_global($type, $name, $value = "", $attr = [])
    {
        $label = ucwords(str_replace("_", " ", $name));
        $return = '<input type="' . ($type == "tanggal" ? "text" : $type) . '" class="form-control ' . ($type == "tanggal" ? "input-group date" : "") . '" ' . ($type == "tanggal" ? "data-date-format='yyyy-mm-dd'" : "") . ' name="' . $name . '" id="' . $name . '" value="' . $value . '" placeholder="' . $label . '" ';
        if ($attr) {
            foreach ($attr as $k => $v) {
                $return .= $k . '="' . $v . '" ';
            }
        }
        $return .= ' />';

        return $return;
    }

    public function initial_image($name, $attr = [])
    {
        $return = "<img ";
        foreach ($attr as $key => $val) {
            $return .= $key . "='" . $val . "' ";
        }
        $return .= " />";
        return $return;
    }

    public function push_error($errors)
    {
        $this->errors = $errors;
    }
}
