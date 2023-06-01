<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>
<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $subscription ? '' : 1 }}" />
<input type="hidden" id="subscription_id" name="subscription_id" value="{{ $subscription ? $subscription->id : '' }}" />
<div class="form-group">
    <label>Name<span style="color:red"> *</span></label>
    <input type="text" name="name" class="form-control" placeholder="Ex. Free Subscription" value="{{ $subscription ? $subscription->name : '' }}">
    <strong class="error" id="name-error"></strong>
</div>
<div class="form-group">
    <label>Type<span style="color:red"> *</span></label>
    <input type="text" name="type" class="form-control valid" placeholder="Ex. Free" value="{{ $subscription ? $subscription->type : '' }}">
    <strong class="error" id="type-error"></strong>
</div>
<div class="form-group">
    <label>Duration<span style="color:red"> *</span></label>
    <input type="text" name="duration" class="form-control" placeholder="Ex. 28" value="{{ $subscription ? $subscription->duration : '' }}">
    <strong class="error" id="duration-error"></strong>
</div>
<div class="form-group">
    <label>price<span style="color:red"> *</span></label>
    <input type="text" name="price" class="form-control" placeholder="Ex. 0" value="{{ $subscription ? $subscription->price : '' }}">
    <strong class="error" id="price-error"></strong>
</div>
<div class="form-group">
    <label>Description<span style="color:red">*</span></label>
    <textarea rows="3" name="description" class="form-control" placeholder="Add description" >{{ $subscription ? $subscription->description : '' }}</textarea>
    <strong class="error" id="description-error"></strong>
</div>