    <?php
    function paginate($reload, $page, $tpages) {
        $adjacents = 2;
        $prevlabel = "&lsaquo; Previous";
        $nextlabel = "Next &rsaquo;";
        $out = "";
        // previous
        if ($page == 1) {
            $out.= "<span>".$prevlabel."</span>";
        } elseif ($page == 2) {
            $out.="<a href=\"".$reload."\">".$prevlabel."</a>";
        } else {
            $out.="<a href=\"".$reload."&amp;page=".($page - 1)."\">".$prevlabel."</a>";
        }

        $pmin=($page>$adjacents)?($page - $adjacents):1;

        $pmax=($page<($tpages - $adjacents))?($page + $adjacents):$tpages;

        for ($i = $pmin; $i <= $pmax; $i++) {
            if ($i == $page) {
                $out.= "<em class = 'current'>".$i."</em>";
            } elseif ($i == 1) {
                $out.= "<a href=\"".$reload."\">".$i."</a>";
            } else {
                $out.= "<a href=\"".$reload. "&amp;page=".$i."\">".$i. "</a>";
            }
        }
        
        if ($page<($tpages - $adjacents)) {
            $out.= "<a href=\"" . $reload."&amp;page=".$tpages."\">" .$tpages."</a>";
        }
        // next
        if ($page < $tpages) {
            $out.= "<a href=\"".$reload."&amp;page=".($page + 1)."\">".$nextlabel."</a>";
        } else {
            $out.= "<span>".$nextlabel."</span>";
        }
        $out.= "";
        return $out;
    }
?>