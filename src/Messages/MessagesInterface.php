<?php namespace Ilyes512\Valiskel\Messages;

interface MessagesInterface
{

    /**
     * Add a new message
     *
     * @param string $key
     * @param string $value
     *
     * @return object $this
     */
    public function add($key, $value);

    /**
     * Recursively merge an array of messages
     *
     * @param \Illuminate\Support\Contracts\MessageProviderInterface|array $messages
     *
     * @return object $this
     */
    public function merge($messages);

    /**
     * Returns the messages in an array
     *
     * @return array
     */
    public function toArray();
}
