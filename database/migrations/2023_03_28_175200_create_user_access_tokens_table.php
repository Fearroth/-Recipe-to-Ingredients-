<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\UserAccessToken;
use App\Models\User;

class CreateUserAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_Access_Tokens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger(UserAccessToken::USER_ID);
            $table->foreign(UserAccessToken::USER_ID)
                ->references(User::ID)
                ->on(User::TABLE)
                ->onDelete('cascade');
            $table->text(UserAccessToken::TOKEN);
            $table->dateTime(UserAccessToken::VALID_TO);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_Access_Tokens');
    }
}