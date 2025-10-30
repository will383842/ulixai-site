public function up()
{
    Schema::table('press', function (Blueprint $table) {
        $table->string('language', 2)->default('fr')->after('description');
    });
}

public function down()
{
    Schema::table('press', function (Blueprint $table) {
        $table->dropColumn('language');
    });
}
