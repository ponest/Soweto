<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class BaseModelObserver
{
    public function created(Model $model)
    {
        try {
            activity()
                ->useLog('create')
                ->causedBy(auth()->user())
                ->performedOn($model)
                ->withProperties([
                    'action' => 'created',
                    'attributes' => $model->getAttributes(),
                    'ip' => request()->ip(),
                    'url' => request()->fullUrl(),
                ])
                ->log('created ' . class_basename($model));
        } catch (\Throwable $e) {
            \Log::error('Activity log failed: ' . $e->getMessage());
        }
    }

    public function updated(Model $model)
    {
        try {
            activity()
                ->useLog('update')
                ->causedBy(auth()->user())
                ->performedOn($model)
                ->withProperties([
                    'action' => 'updated',
                    'old' => $model->getOriginal(),
                    'new' => $model->getChanges(),
                    'ip' => request()->ip(),
                    'url' => request()->fullUrl(),
                ])
                ->log('updated ' . class_basename($model));
        } catch (\Throwable $e) {
            \Log::error('Activity log failed: ' . $e->getMessage());
        }
    }

    public function deleted(Model $model)
    {
        activity()
            ->useLog('delete')
            ->causedBy(auth()->user())
            ->performedOn($model)
            ->withProperties([
                'action' => 'deleted',
                'attributes' => $model->getAttributes(),
                'ip' => request()->ip(),
                'url' => request()->fullUrl(),
            ])
            ->log('deleted ' . class_basename($model));
    }
}
