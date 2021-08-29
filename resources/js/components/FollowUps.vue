<template>
    <div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h6>PSS Follow Ups</h6>
                </div>
                <div class="pull-right">

                    <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addFollowUpModal">
                        Add
                    </button>                                    
                </div>
            </div>
        </div>

        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
        

    </div>
</template>

<script>
    export default {
        data() {
            return {
            
            }
        }
    }
</script>