<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //users
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('roles');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        //customers
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('customer_id');
            $table->text('title');
            $table->text('lname');
            $table->text('fname');
            $table->text('addressline');
            $table->text('town');
            $table->text('zipcode');
            $table->text('phone');
            $table->text('img_path')->default('images/customers.jpg');
            $table->timestamps();
            // $table->softDeletes();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
        
        //technicians
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('employee_id');
            $table->text('title');
            $table->text('lname');
            $table->text('fname');
            $table->text('addressline');
            $table->text('town');
            $table->text('zipcode');
            $table->text('phone');
            $table->text('img_path')->default('images/employees.jpg');
            $table->timestamps();
            // $table->softDeletes();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        //services
        Schema::create('services', function (Blueprint $table) {
            $table->increments('service_id');
            $table->text('description');
            $table->integer('price');
            $table->text('img_path')->default('images/services.jpg');
            $table->timestamps();
            // $table->softDeletes();
        });

        //suppliers 
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('supplier_id');
            $table->text('name');
            $table->text('addressline');
            $table->text('img_path')->default('images/suppliers.jpg');
            $table->timestamps();
        });

        //devices
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('device_id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->text('type');
            $table->text('brand');
            $table->text('model');
            $table->text('img_path')->default('images/devices.jpg');
            $table->timestamps();
            $table->softDeletes();
        });

        //supplies
        Schema::create('supplies', function (Blueprint $table) {
            $table->increments('supply_id');
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->text('description');
            $table->integer('price');
            $table->integer('quantity');
            $table->text('img_path')->default('images/supplies.jpg');
            $table->timestamps();
        });

        //stocks
        Schema::create('stocks', function (Blueprint $table) {
            $table->integer('supply_id')->unsigned();
            $table->foreign('supply_id')->references('supply_id')->on('supplies')->onDelete('cascade')->onUpdate('cascade');

            $table->text('quantity');
        });

        //repairinfo
        Schema::create('repairinfo', function (Blueprint $table) {
            $table->increments('repairinfo_id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date_placed');
            $table->text('status');
            $table->timestamps();
            // $table->softDeletes();
        });

        //repairline
        Schema::create('repairline', function (Blueprint $table) {
            $table->integer('repairinfo_id')->unsigned();
            $table->foreign('repairinfo_id')->references('repairinfo_id')->on('repairinfo')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('service_id')->on('services')->onDelete('cascade')->onUpdate('cascade');
        });

        //stockinfo
        Schema::create('stockinfo', function (Blueprint $table) {
            $table->increments('stockinfo_id');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date_placed');
            $table->text('status');
            $table->timestamps();
            // $table->softDeletes();
        });

        //stockline
        Schema::create('stockline', function (Blueprint $table) {
            $table->integer('stockinfo_id')->unsigned();
            $table->foreign('stockinfo_id')->references('stockinfo_id')->on('stockinfo')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('supply_id')->unsigned();
            $table->foreign('supply_id')->references('supply_id')->on('supplies')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('services');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('devices');
        Schema::dropIfExists('supplies');
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('repairinfo');
        Schema::dropIfExists('repairline');
        Schema::dropIfExists('stockinfo');
        Schema::dropIfExists('stockline');
    }
};
