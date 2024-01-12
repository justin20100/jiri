
<tbody class="table__body">
    @foreach($this->projects as $project)
        <tr class="table__body__line">
            <td class="table__body__line__cell">{{$project->title}}</td>
            <td class="table__body__line__cell">{{$project->description}}</td>
            <td class="table__body__line__cell">{{$project->created_at}}</td>
            <td class="table__body__line__cell">
                {{--  icon avec trois petits points pour afficher le mini dialog --}}
                <div class="table__body__line__cell__icon">
                    <svg class="table__body__line__cell__icon__svg">
                        <use xlink:href="{{asset("images/sprite.svg#more")}}"></use>
                    </svg>
                </div>

                {{-- Creer un composant livewire pour faire aparaitre un mini dialog avec une icone de supression et une icone de modification --}}

                {{--                                <div class="table__body__line__row__dialog">--}}
                {{--                                    <a href="{{route('projects.edit', $project->id)}}" class="table__body__line__row__dialog__edit">--}}
                {{--                                        <svg class="table__body__line__row__dialog__edit__svg">--}}
                {{--                                            <use xlink:href="{{asset("images/sprite.svg#edit")}}"></use>--}}
                {{--                                        </svg>--}}
                {{--                                    </a>--}}
                {{--                                    <form action="{{route('projects.destroy', $project->id)}}" method="POST" class="table__body__line__row__dialog__delete">--}}
                {{--                                        @csrf--}}
                {{--                                        @method('DELETE')--}}
                {{--                                        <button type="submit" class="table__body__line__row__dialog__delete__button">--}}
                {{--                                            <svg class="table__body__line__row__dialog__delete__button__svg">--}}
                {{--                                                <use xlink:href="{{asset("images/sprite.svg#delete")}}"></use>--}}
                {{--                                            </svg>--}}
                {{--                                        </button>--}}
                {{--                                    </form>--}}
                {{--                                </div>--}}

            </td>
        </tr>
    @endforeach
</tbody>
