<?php

return [
    'patient_registration'         => [
        'title'          => 'Patient Registrations',
        'title_singular' => 'New Registration',
        'fields'         => [
            'id'                => 'ID',
            'designation'       => 'Designation',
            'first_name'        => 'First Name',
            'last_name'         => 'Last Name',
            'name'              => 'Name',
            'email'             => 'Email Id',
            'age'               => 'Age',
            'age_type'          => 'Age Type',
            'mobile'            => 'Mobile',
            'gender'            => 'Gender',
            'address'           => 'Address',
            'created_at'        => 'Created At',
            'updated_at'        => 'Updated At',
        ],
    ],

    'department'         => [
        'title'          => 'Departments',
        'title_singular' => 'Department ',
        'fields'         => [
            'id'            => 'ID',
            'designation'   => 'Designation',
            'title'         => 'Title',
            'description'   => 'Description',
            'slug'          => 'Slug',
            'status'        => 'Status',
            'created_by'    => 'Created By',
            'updated_by'    => 'Updated By',
            'deleted_by'    => 'Deleted By',
        ],
    ],

    'test'         => [
        'title'          => 'Tests',
        'title_singular' => 'Test',
        'fields'         => [
            'id'            => 'ID',
            'dept_id'       => 'Department',
            'title'         => 'Test Name',
            'amount'          => 'amount',
            'code'          => 'Code',
            'gender'        => 'Gender',
            'sample_type'   => 'Sample Type',
            'age'           => 'Age',
            'suffix'        => 'Suffix',
            'type'          => 'Type',
            'test_name'     => 'Name',
            'test_method'   => 'Test Method',
            'field'         => 'Field',
            'unit'          => 'Unit',
            'range_min'     => 'Range Min',
            'range_max'     => 'Range Max',
            'created_by'    => 'Created By',
            'updated_by'    => 'Updated By',
            'deleted_by'    => 'Deleted By',
            'created_at'        => 'Created At',
            'updated_at'        => 'Updated At',

        ],
    ],

    'package'         => [
        'title'          => 'Package',
        'title_singular' => 'Package',
        'fields' => [
            'name'       => 'Name',
            'code'       => 'Code',
            'amount'     => 'Amount',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'deleted_by' => 'Deleted By',
        ],

    ],

    'lab'         => [
        'title'          => 'Lab',
        'title_singular' => 'Lab Management',
        'fields' => [
            'name'       => 'Name',
            'code'       => 'Code',
            'amount'     => 'Amount',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'deleted_by' => 'Deleted By',
        ],

    ],

    'organisation'         => [
        'title'          => 'Organsation',
        'title_singular' => 'Organisation',
        'fields' => [
            'id' => 'Id',
            'ref_type'    => 'Referral Type',
            'name'        => 'Name',
            'compliment'  => 'Compliment',
            'username'    => 'Username',
            'password'    => 'Password',
            'mobile'      => 'Mobile Number',
            'login_status' => 'Login Access',
            'test_id'     => 'Test ID',
            'created_by'  => 'Created By',
            'updated_by'  => 'Updated By',
            'deleted_by'  => 'Deleted By',
        ],

    ],


];
