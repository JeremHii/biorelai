<?php

class Table{
    private $header;
    private $rows;

    public function __construct(array $header)
    {
        $this->header = $header;
        $this-> rows = array();
    }

    public function addRow(array $row){
        array_push($this->rows, $row);
    }

    public function show(){
        $table = "<table border='1' style='margin-left:auto; margin-right: auto;'>";
        $table .=   "<thead>";
        $table .=       "<tr>";

        foreach($this->header as $column){
            $table .= "<th>" . $column . "</th>";  
        }

        $table .=       "</tr>";
        $table .=   "</thead>";

        $table .=   "<tbody>";
        

        foreach($this->rows as $row){
            $table .= "<tr>";
            
            foreach($row as $column){
                $table .= "<td>";

                if($column instanceof TableLink){
                    $table .= "<a href='" . $column->getLink() . "' target='" . $column->getTarget() . "'>" . $column->getText() . "</a>";
                }else{
                    $table .= $column;
                }

                $table .= "</td>";  
            }
            
            $table .= "</tr>";
        }

        
        $table .=   "</tbody>";
        $table .= "</table>";

        echo $table;
    }
}

class TableLink{
    private $text;
    private $link;
    private $target;

    public function __construct(string $text, string $link, string $target = "_self")
    {
        $this->text = $text;
        $this->link = $link;
        $this->target = $target;
    }

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get the value of link
     */ 
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Get the value of target
     */ 
    public function getTarget()
    {
        return $this->target;
    }
}