Import用のファイル
・_configuration.scss → カラーコード、mixin、メディアクエリなどを格納するファイル
・_base.scss → htmlタグのデフォルトのスタイルを設定するファイル、基本t形にはクラス名は使わないでhtmlタグにスタイルを当てる
・_modifier.scss → 単体で使うモディファイを格納するファイル（-sp-onlyなど）

ファイル名の接頭語
・l-- → layoutのスタイル
・c-- → componentのスタイル
・m-- → moduleのスタイル
・js-- → jsで使うスタイル（アコーディオンやハンバーガーなど）

/Assets/scss内にファイルを作成したら、/Assets/css内に自動的にファイルがコンパイルされる
また、vanilla-wp-settings.phpで/Assets/css内のファイルを全て取得し、wpに読み込ませるようにしている（jsも同様）
