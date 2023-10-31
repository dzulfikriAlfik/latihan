<script>
export default {
    methods: {
        submitRequest() {
            alert("submitted")
        }
    },
    mounted () {
        console.log("mounted");
    },
};
</script>

<template>
    <div class="mt-5">
        <div class="card col-md-6 offset-3">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body">
                <form @submit.prevent="submitRequest()">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>
