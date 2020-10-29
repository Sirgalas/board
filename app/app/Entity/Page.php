<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Entity\Page
 *
 * @property int $id
 * @property string $title
 * @property string $menu_title
 * @property string $slug
 * @property string $content
 * @property string $description
 * @property int|null $parent_id
 *
 * @property int $depth
 * @property Page $parent
 * @property Page[] $children
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @mixin \Eloquent
 */
class Page extends Model
{
    use NodeTrait;

    protected $table = 'pages';

    protected $guarded = [];

    public function getPath():string
    {
        return $this->implode('/',array_merge($this->ancestors()->defaultOrder()->pluck('slug')->toArray(), [$this->slug]));
    }

    public function getMenuTitle():string
    {
        return $this->menu_title?? $this->title;
    }
}
