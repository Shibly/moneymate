<form action="{{route('budget.update', [$budget->id])}}" method="POST" id="updateBudget">
    @csrf
    <div class="modal-body">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div>
                    <label class="form-label">Budget Name: <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="budget_name" value="{{$budget->budget_name}}"
                           placeholder="Budget Name">
                    <div class="text-danger pt-2 budget_name"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Select Currency: <span
                            class="text-danger">*</span></label>
                    <select name="currency_id" class="form-control">
                        <option value="">Select Currency</option>
                        @foreach($currencies as $currency)
                            <option
                                value="{{$currency->id}}" {{$budget->currency_id == $currency->id ? 'selected' : ''}} >{{$currency->name}}</option>
                        @endforeach
                    </select>
                    <div class="text-danger mt-2 currency_id"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Budget Amount: <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="amount" value="{{$budget->amount}}"
                           placeholder="Budget Amount">
                    <div class="text-danger pt-2 amount"></div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">

                @php
                    $selectedCategoryIds = [];
                    foreach ($budget->categories as $selectedCategory)
                        {
                            $selectedCategoryIds[] = $selectedCategory->id;
                        }
                @endphp

                <div>
                    <label class="form-label">Expense Category: <span
                            class="text-danger">*</span></label>
                    <select name="categories[]" class="form-control" multiple>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                    @if(in_array($category->id, $selectedCategoryIds)) selected @endif >{{$category->name}}</option>
                        @endforeach
                    </select>
                    <div class="text-danger mt-2 categories"></div>
                </div>


                <div class="mb-3">
                    <label class="form-label">Start Date: <span class="text-danger">*</span></label>
                    <div class="input-icon mb-2">
                        <input class="form-control datepicker" name="start_date"
                               placeholder="Start Date"
                               value="{{$budget->start_date}}"/>
                        <span class="input-icon-addon"><x-tabler-calendar/></span>
                    </div>

                    <div class="text-danger pt-2 start_date"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">End Date: <span class="text-danger">*</span></label>
                    <div class="input-icon mb-2">
                        <input class="form-control datepicker" name="end_date"
                               placeholder="Start Date"
                               value="{{$budget->end_date}}"/>
                        <span class="input-icon-addon"><x-tabler-calendar/></span>
                    </div>

                    <div class="text-danger pt-2 end_date"></div>
                </div>

            </div>
        </div>
        <div class="logical-error d-none alert alert-danger"></div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary action-button">Update Budget</button>
    </div>
</form>
