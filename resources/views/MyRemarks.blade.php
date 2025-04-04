<div>
    <h3 class="mt-4 p-5 font-bold text-black-50">Some remarks:</h3>
    <p>
        Laravel's Contextual Binding allows to specify which concrete implementation class to inject by Service Container when two or more classes
        implement the same interface like:
        
            <pre><code>
            $this->app->when(PhotoController::class)
                ->needs(Filesystem::class)
                ->give(function () {
                    return Storage::disk('local');
                });
            
            $this->app->when([VideoController::class, UploadController::class])
                ->needs(Filesystem::class)
                ->give(function () {
                    return Storage::disk('s3');
                });
            </code></pre>

        

        This is excellent to have this ability in Laravel, however, this also discourages people to learn and take advantage of Strategy design pattern
        to tackle this kind of common problems in general.

    </p>
</div>