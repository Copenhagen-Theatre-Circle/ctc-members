<nav class="menu">
    <ul class="menu-list">

        @foreach ($panels as $key=>$panel)
            <li>
                <a href="#{{$key}}" :class="{ 'is-active': activePanel=='{{$key}}' }" @click="changeActivePanel('{{$key}}')">
                    <span class="icon">
                        <i class="{{$panel['icon']}}"></i>
                    </span>
                    {{$panel['name']}}
                </a>
            </li>
        @endforeach
        <hr>
        <li v-show="mode=='show'">
            <a @click="mode='edit'">
                <span class="icon">
                    <i class="fas fa-pencil-alt"></i>
                </span>
                Edit
            </a>
        </li>
        <li v-show="mode=='edit'" v-cloak>
            <a @click="submitForm" class="is-active">
                <span class="icon">
                    <i class="fas fa-pencil-alt"></i>
                </span>
                Edit
            </a>
        </li>
    </ul>
</nav>

