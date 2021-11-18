<?php

/**
* @param header - Array contenant le nom des colonnes du tableau
* @param title - Titre donné au tableau 
*/
class Table{
    private $header;
    private $rows;
    private $title;

    public function __construct(array $header, $title="")
    {
        $this->header = $header;
        $this->rows = array();
        $this->title = $title;
    }

    public function addRow($row){
        array_push($this->rows, $row);
    }

    public function show(){
        $table = "";
        if($this->title != ""){
            $table = $this->title . "<br>";
        }
        $table .= "<table border='1' style='margin-left:auto; margin-right: auto;'>";
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

            if($row instanceof RowForm){
                $table .= "<form target='_self' action=' ' method='POST' id='" . $row->getId() . "'>";

                foreach($row->getCells() as $cell){
                    
                    if(!($cell instanceof RowFormHidden)){
                        $table .= "<td>";
                    }

                    if($cell instanceof RowFormInput){
                        $table .= "<input form='" . $row->getId() . "' type='text' value='" . $cell->getValue() . "' placeholder='" . $cell->getPlaceholder() . "' name='" . $cell->getName() . "' " . ($cell->getRequired() ? "required" : "") . "/>";
                    }
                    else if($cell instanceof RowFormHidden){
                        $table .= "<input form='" . $row->getId() . "' name='" . $cell->getName() . "' type='hidden' value='" . $cell->getValue() . "'/>";
                    }
                    else if($cell instanceof RowFormLabel){
                        $table .= $cell->getText();
                    }

                    if(!($cell instanceof RowFormHidden)){
                        $table .= "</td>";
                    }
                }

                $table .= "<td><input form='" . $row->getId() . "' type='submit' value='" . $row->getSubmit()->getText() . "' name='" . $row->getSubmit()->getName() . "'/></td>";

                $table .= "</form>";
            }
            else{
                foreach($row as $column){
                    $table .= "<td>";
    
                    if($column instanceof TableLink){
                        $table .= "<a href='" . $column->getLink() . "' target='" . $column->getTarget() . "'>" . $column->getText() . "</a>";
                    }else{
                        $table .= $column;
                    }
    
                    $table .= "</td>";  
                }
            }
            
            
            $table .= "</tr>";
        }
        
        $table .=   "</tbody>";
        $table .= "</table>";

        echo $table;
    }
}

/*
Permet de créer une cellule lien dans un tableau
*/
class TableLink{
    private $text;
    private $link;
    private $target;

    public function __construct(string $text, $link, string $target = "_self")
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

/*
Permet de créer une ligne contenant un formulaire
*/
class RowForm{
    private $id;
    private $cells;
    private $submit;

    public function __construct(string $id, array $cells, $submit){
        $this->id = $id;
        $this->cells = $cells;
        $this->submit = $submit;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of cells
     */ 
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * Set the value of cells
     *
     * @return  self
     */ 
    public function setCells($cells)
    {
        $this->cells = $cells;

        return $this;
    }

    /**
     * Get the value of submit
     */ 
    public function getSubmit()
    {
        return $this->submit;
    }

    /**
     * Set the value of submit
     *
     * @return  self
     */ 
    public function setSubmit($submit)
    {
        $this->submit = $submit;

        return $this;
    }
}

/*
Permet d'ajouter un input à une ligne de type form
*/
class RowFormInput{
    private $name;
    private $value;
    private $placeholder;
    private $required;

    public function __construct($name, $value = "", $placeholder = "", $required = 0)
    {
        $this->name = $name;
        $this->value = $value;
        $this->placeholder =$placeholder;
        $this->required = $required;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of value
     */ 
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */ 
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value of placeholder
     */ 
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Set the value of placeholder
     *
     * @return  self
     */ 
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Get the value of required
     */ 
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * Set the value of required
     *
     * @return  self
     */ 
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }
}

/*
Permet d'ajouter un champ invisible à une ligne de type form
*/
class RowFormHidden{
    private $name;
    private $value;

    public function __construct($name, $value = "")
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of value
     */ 
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */ 
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}

/*
Permet d'ajouter un label à une ligne de type form
*/
class RowFormLabel{
    private $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}

/*
Permet de mettre un bouton submit à une ligne de type form
*/
class FormSubmit{
    private $name;
    private $text;

    public function __construct($name, $text){
        $this->name = $name;
        $this->text = $text;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}