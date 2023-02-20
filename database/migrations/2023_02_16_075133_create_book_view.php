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
        \DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());
    }

        /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function createView(): string
    {
        return SQL
            CREATE VIEW view_author_data AS
                SELECT 
                    mst_author.id, 
                    mst_author.name, 
                    mst_author.email,
                    (SELECT count(*) FROM mst_books
                                WHERE mst_books.author_id = mst_author.id
                            ) AS total_posts
                FROM mst_author
            SQL;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return SQL

            DROP VIEW IF EXISTS `view_author_data`;
            SQL;
    }
};
