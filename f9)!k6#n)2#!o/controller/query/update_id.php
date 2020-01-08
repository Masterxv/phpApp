<?php
$request->validate([
            "name" => "required",
            "auth_providers" => "required",
            "tables" => "required",
            "commands" => "required",
        ]);
        Query::findOrFail($request->id)->update([
            'name' => $request->name,
            "auth_providers" => $request->auth_providers,
            "tables" => $request->tables,
            "commands" => $request->commands,
            "fillables" => $request->fillables??null,
            "hiddens" => $request->hiddens??null,
            "mandatory" => $request->mandatory??null,
            "joins" => $request->joins??null,
            "filters" => $request->filters??null,
            "specials" => $request->specials??null,
        ]);
        return redirect()->route('c.query.list.view');
        ?>