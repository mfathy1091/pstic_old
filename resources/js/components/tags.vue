<template>
    <div>
       <div class="content">
			<div class="container-fluid">


				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Tags <Button @click="addModal=true"><Icon type="ios-add" />Add tag</Button></p>

					<div class="_overflow _table_div">
						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>ID</th>
								<th>Tag Name</th>
								<th>Created At</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr v-for="(tag, i) in tags" :key="i" v-if="tags.length">
								<td>{{tag.id}}</td>
								<td class="_table_name">{{tag.tagName}}</td>
								<td>{{tag.created_at}}</td>
								<td>
									<Button type="info" size="small">Info</Button>
									<Button type="error" size="small">Error</Button>
								</td>
							</tr>

							
						</table>
					</div>
				</div>

				<!-- tag adding modal -->
				<Modal
					v-model="addModal"
					title="Add Tag"
					:mask-closable = "false"
					:closable = "false"
					>

					<Input v-model="data.tagName" placeholder="Add tag name"/>

					<div slot="footer">
						<Button type="default" @click="addModal=false">Close</Button>
						<Button type="primary" @click="addTag" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding..' : 'Add Tag'}}</Button>
					</div>
				</Modal>

			</div>
		</div>
    </div>
</template>
<script>
	export default {
		data() {
			return {
				data : {
					tagName: ''
				},
				addModal : false,
				isAdding : false,
				tags: [],
			}
		},
		methods: {
			async addTag(){
				if(this.data.tagName.trim()=='') return this.error('Tag name is required')
				const res = await this.callApi('post', 'app/create_tag', this.data)
				if(res.status==201){
					this.tags.unshift(res.data)
					this.success('Tag has been added successfuly!')
					this.addModal = false
					this.data.tagName = ""
				}else{
					this.generic()
				}
			}
		},
		async created() {
			const res = await this.callApi('get', 'vue/get-individuals')
			if(res.status==200)
			{
				this.tags = res.data
			}else{
				this.generic()
			}
		}
	}
</script>