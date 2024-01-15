<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectWilayah extends Component
{
    /**
     *
     * @var mixed
     */
    public $isInline;
    
    /**
     *
     * @var mixed
     */
    public $listType;
    
    /**
     *
     * @var mixed
     */
    public $label;

    /**
     *
     * @var mixed
     */
    public $value;

    /**
     *
     * @var mixed
     */
    public $type;

    /**
     *
     * @var mixed
     */
    public $name;

    /**
     *
     * @var mixed
     */
    public $id;

    /**
     *
     * @var mixed
     */
    public $targetId;

    /**
     *
     * @var mixed
     */
    public $labelRequired;

    /**
     * Create a new component instance.
     *
     * @param bool $isInline
     * @param string $listType
     * @param string $label
     * @param string $value
     * @param string $name
     * @param string $id
     * @param string $targetId
     * @param bool $labelRequired
     * 
     * @return void
     */
    public function __construct(
        $isInline = false,
        $listType = 'provinsi',
        $label = 'Provinsi',
        $value = "",
        $name = 'provinsi_id',
        $id = 'provinsi_id',
        $targetId = '#kabupaten_id',
        $labelRequired = true
    ) {
        $this->isInline = $isInline;
        $this->listType = $listType;
        $this->label = $label;
        $this->value = $value;
        $this->name = $name;
        $this->id = $id;
        $this->targetId = $targetId;
        $this->labelRequired = $labelRequired;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-wilayah');
    }
}
