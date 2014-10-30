<?php

class Vote extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'votes';

    /**
     * The primary key of the table.
     * 
     * @var string
     */
    protected $primaryKey = 'vote_id';

    /**
     * The attributes of the model.
     * 
     * @var array
     */
    protected $guarded = array('vote_id', 'vote_name', 'vote_sponsor', 'vote_create_time', 'vote_end_time', 'vote_is_multiple');

    /**
     * The field needs to be filled when ::create() method is invoked.
     * 
     * @var array
     */
    protected $fillable = array('vote_name', 'vote_sponsor', 'vote_end_time', 'vote_is_multiple');

    /**
     * Disabled the `update_at` field in this table.
     * 
     * @var boolean
     */
    public $timestamps = false;
}
