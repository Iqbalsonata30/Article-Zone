<div class="overflow-x-auto w-full hidden md:block">
    <table class="table w-full ">
        <thead>
            <tr>
                <th>User</th>
                <th>Total Posts</th>
                <th>Total Comments</th>
            </tr>
        </thead>
        {{ $slot }}
        <tfoot>
            <tr>
                <th>User</th>
                <th>Total Posts</th>
                <th>Total Comments</th>
            </tr>
        </tfoot>
    </table>
</div>
