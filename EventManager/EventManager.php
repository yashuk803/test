<?php

interface IEventManager
{
    public function addEventListener($type, callable $callback);
    public function fireEvent($type);
}


class EventManager implements IEventManager
{
    private $events;

    public function addEventListener($type, callable $callback)
    {
        $classCaller = new stdClass();
        $classCaller->type = $type;
        $classCaller->callback = $callback;
        $this->events[] = $classCaller;
    }

    public function fireEvent($type)
    {
        foreach ($this->events as $item) {

            if($item->type === $type) {
                \call_user_func($item->callback);
            }
        }

    }
}

$firstFunc = function() {
    echo "called first\n";
};

$secondFunc = function() {
    echo "called second\n";
};

$thirdFunc = function() {
    echo "called third\n";
};

$em = new EventManager();
$em->addEventListener("type_one", $firstFunc);
$em->addEventListener("type_two", $secondFunc);
$em->addEventListener("type_two", $thirdFunc);


$em->fireEvent("type_one");
$em->fireEvent("type_two");
