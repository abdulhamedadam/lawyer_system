<div class="card shadow" style="border-top: 3px solid #007bff; background-color: #f8f9fa;">
    <div class="card-body text-center">
        <i class="bi bi-person-circle text-primary" style="font-size: 5rem;"></i>
        <h3 class="card-title mt-3"><?= $all_data->name ?></h3>
    </div>
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="bi bi-person"></i> <?= translate('Client') ?>:</span>
            <span><?= $all_data->name ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="bi bi-telephone"></i> <?= translate('Phone') ?>:</span>
            <span><?= $all_data->phone_number ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="bi bi-card"></i> <?= translate('National ID') ?>:</span>
            <span><?= $all_data->national_id ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="bi bi-house-door"></i> <?= translate('Current Address') ?>:</span>
            <span class="text-decoration-blue"><?= $all_data->current_address ?></span>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="bi bi-briefcase"></i> <?= translate('Job') ?>:</span>
            <span class="text-decoration-blue"><?= $all_data->job ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="bi bi-flag"></i> <?= translate('Nationality') ?>:</span>
            <span class="text-decoration-blue"><?= $all_data->nationality ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="bi bi-star"></i> <?= translate('Religion') ?>:</span>
            <span class="text-decoration-blue"><?= $all_data->religion ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="bi bi-geo-alt"></i> <?= translate('Governate') ?>:</span>
            <span class="text-decoration-blue"><?= $all_data->governate ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="bi bi-building"></i> <?= translate('City') ?>:</span>
            <span class="text-decoration-blue"><?= $all_data->city ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="bi bi-calendar"></i> <?= translate('Age') ?>:</span>
            <span class="text-decoration-blue"><?= CalculateAge($all_data->date_of_birth_ar) ?></span>
        </li>
    </ul>
</div>
