<?php

use App\Models\User;
use Ffhs\FilamentPackageFfhsComments\Comments\Providers\TopicProvider;
use Ffhs\FilamentPackageFfhsComments\Resources\CommentsResource;

return [

    /*
     * The comment class that should be used to store and retrieve
     * the comments.
     */
    'comment_class' => \Ffhs\FilamentPackageFfhsComments\Comments\Models\Comment::class,

    /*
     * The user model that should be used when associating comments with
     * commentators. If null, the default user provider from your
     * Laravel authentication configuration will be used.
     */
    'user_model' => User::class,

    /*
     * Here you can override the resources used for the general inbox
     */
    'resources_list' => [
        CommentsResource::class,
    ],

    /**
     * Here you can define how the topic looks like on new comments (dropdown or free-text)
     */
    'topic_provider' => TopicProvider::class,

];
