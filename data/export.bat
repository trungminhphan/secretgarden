mongoexport --db secretgarden --collection fs.chunks --out fs.chunks.json
mongoexport --db secretgarden --collection fs.files --out fs.files.json
mongoexport --db secretgarden --collection hub --out hub.json
mongoexport --db secretgarden --collection languages --out languages.json
mongoexport --db secretgarden --collection menu --out menu.json
mongoexport --db secretgarden --collection sessions --out sessions.json
mongoexport --db secretgarden --collection translate_path --out translate_path.json
mongoexport --db secretgarden --collection translate_var --out translate_var.json
mongoexport --db secretgarden --collection users --out users.json

mongoexport --db secretgarden_1 --collection fs.chunks --out fs.chunks_1.json
mongoexport --db secretgarden_1 --collection fs.files --out fs.files_1.json
mongoexport --db secretgarden_1 --collection hub --out hub_1.json
mongoexport --db secretgarden_1 --collection languages --out languages_1.json
mongoexport --db secretgarden_1 --collection menu --out menu_1.json
mongoexport --db secretgarden_1 --collection sessions --out sessions_1.json
mongoexport --db secretgarden_1 --collection translate_path --out translate_path_1.json
mongoexport --db secretgarden_1 --collection translate_var --out translate_var_1.json
mongoexport --db secretgarden_1 --collection users --out users_1.json