<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('
        CREATE TRIGGER update_user_vendor_permissions
        AFTER DELETE ON permissions
        FOR EACH ROW
        BEGIN
            UPDATE user_vendor_permissions
            SET permission_id = NULL
            WHERE permission_id = OLD.id;
        END;
        ');
    }

    public function down(): void
    {
        Schema::dropIfExists('trigger_user_vendor_permission');
    }
};
