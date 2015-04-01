<?php namespace RouterOsStumbler;

class Site
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Survey[]
     */
    public $surveys = [];

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->getId();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Survey $survey
     */
    public function addSurvey(Survey $survey)
    {
        $this->surveys[] = $survey;
    }

    /**
     * @return Survey[]
     */
    public function getSurveys()
    {
        return $this->surveys;
    }


}