<h2>Categories</h2>
<form action="/admins/categories" method="post">
    @csrf
    <div class="form-group">
        <input type="text" name="name" class="form-control" required autocomplete="off">
        <label class="form-control-placeholder" for="name">Name</label>
        <button type="submit"
                class="btn btn-primary">
            Add Category
        </button>
    </div>
</form>

