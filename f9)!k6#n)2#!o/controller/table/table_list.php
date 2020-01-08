<?php
$tables = $this->getTablesWithSizes();
        $size = 0;
        foreach ($tables as $table) {
            $size = $size + $table['size'];
        }
        $page = $request->page;
        $urls = $this->paginate_urls($tables, 10, $page);
        $np = count($urls);
        return view($this->theme.'.db.mytable_list')->with([
            'tables' => $this->paginate_arr($tables, 10, $page), 
            'page' => $page?max(1,min($page,$np)):1,
            'urls' => $urls,
            'np' => $np,
            'size' => $size,
        ]);
        ?>