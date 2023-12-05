<?php

namespace App\Filament\Resources\CommentResource\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Comment;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\CommentResource;

class LatestCommentsWidget extends BaseWidget
{

    protected int | string | array $columnSpan= 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Comment::whereDate('created_at','>',now()->subDays(14)->startOfDay())
            )
            ->columns([
                TextColumn::make('user.name'),
                TextColumn::make('post.title'),
                TextColumn::make('comment'),
                TextColumn::make('created_at')->date()->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('View')
                ->url(fn(Comment $record) : string => CommentResource::getUrl('edit',['record'=>$record]))
            ]);
    }
}
