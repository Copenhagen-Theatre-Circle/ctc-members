<nav class="menu">
    <ul class="menu-list">
        <li>
            <a
                href="{{url('jubilee-book/'.$person->uniqid . '/step-3')}}"
                @if($type == 'index') class="is-active" @endif
            >
                <span class="icon">
                    <i class="fas fa-align-justify"></i>
                </span>
                Instructions for Step 3
            </a>
        </li>
        <hr>
        @foreach ($sidebardata as $key => $sidebargroup)
        <p class="menu-label">
            {{$key}}:
        </p>
            @foreach ($sidebargroup as $sidebaritem)
                <li>
                    <a
                        @if ($key == 'shows')
                            href="{{url('jubilee-book/'.$person->uniqid . '/step-3/'.$sidebaritem->id.'/edit')}}"
                        @elseif ($key=='essays' or $key=='series')
                            href="{{url('jubilee-book/'.$person->uniqid . '/step-3/essays/'.$sidebaritem->id.'/edit')}}"
                        @endif

                        @if(
                                (
                                    ($type == 'show' and $key=='shows')
                                    or
                                    ($type == 'essay' and ($key=='essays' or $key=='series'))
                                )
                                and $id==$sidebaritem->id
                            )
                            class="is-active"
                        @endif
                    >
                        <span class="icon
                            @if(
                                (
                                    ($type == 'show' and $key=='shows')
                                    or
                                    ($type == 'essay' and ($key=='essays' or $key=='series'))
                                )
                                and $id==$sidebaritem->id
                            )
                                has-text-white
                            @elseif ($sidebaritem->completion=='complete')
                                has-text-success
                            @elseif ($sidebaritem->completion=='in progress')
                                has-text-warning
                            @elseif ($sidebaritem->completion=='empty')
                                has-text-danger
                            @endif
                            ">
                            @if ($sidebaritem->completion =='complete')
                               <i class="fas fa-check-circle"></i>
                            @elseif ($sidebaritem->completion == 'in progress')
                                <i class="fas fa-pencil-alt"></i>
                            @elseif ($sidebaritem->completion == 'empty')
                                <i class="fas fa-times-circle"></i>
                            @endif
                        </span>
                        {{$sidebaritem->name}}
                    </a>
                </li>
            @endforeach
            <hr>
        @endforeach
        <li>
            <a href="/jubilee-book/{{$person->uniqid}}/step-2">
                <span class="icon">
                    <i class="fas fa-chevron-left"></i>
                </span>
                back to step 2
            </a>
        </li>
    </ul>
</nav>

