<?php
class Product{
    protected $id;
    protected $title;
    protected $price;
    protected $img;


    public function __construct($id,$price,$title,$img){
        $this->id=$id;
        $this->title=$title;
        $this->price=$price;
        $this->img=$img;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img): void
    {
        $this->img = $img;
    }
    
}
class  Bicycle extends Product {
    protected $wheel;
    protected $frame;
    protected $color;
    protected $date;

    public function __construct($id,$price,$title,$img,$wheel,$frame,$color,
$date){
        $this->id=$id;
        $this->title=$title;
        $this->price=$price;
        $this->img=$img;
        $this->wheel=$wheel;
        $this->frame=$frame;
        $this->color=$color;
        $this->date=$date;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getWheel()
    {
        return $this->wheel;
    }

    /**
     * @param mixed $wheel
     */
    public function setWheel($wheel): void
    {
        $this->wheel = $wheel;
    }

    /**
     * @return mixed
     */
    public function getFrame()
    {
        return $this->frame;
    }

    /**
     * @param mixed $frame
     */
    public function setFrame($frame): void
    {
        $this->frame = $frame;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }
    
    
}

class  UsedBicycle extends Bicycle {
    protected $used;

    public function __construct($id,$price,$title,$img,$wheel,$frame,$color,
                                $date,$used){
        $this->id=$id;
        $this->title=$title;
        $this->price=$price;
        $this->img=$img;
        $this->wheel=$wheel;
        $this->frame=$frame;
        $this->color=$color;
        $this->date=$date;
        $this->used=$used;
    }

    /**
     * @return mixed
     */
    public function getUsed()
    {
        return $this->used;
    }

    /**
     * @param mixed $used
     */
    public function setUsed($used): void
    {
        $this->used = $used;
    }
    
    


}
class  accessories extends Product {
    protected $description;

    public function __construct($id,$price,$title,$img,$description){
        $this->id=$id;
        $this->title=$title;
        $this->price=$price;
        $this->img=$img;
        $this->description=$description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }
    


}
