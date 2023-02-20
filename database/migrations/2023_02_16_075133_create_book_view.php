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
        \DB::statement("CREATE VIEW view_books_author_data AS SELECT mst_author.id, mst_author.name, (SELECT count(*) FROM mst_books WHERE mst_books.author_id = mst_author.id ) AS total_books FROM mst_author");
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
        return CREATE VIEW view_book_author_data AS
                SELECT 
                    mst_author.id, 
                    mst_author.name, 
                    (SELECT count(*) FROM mst_books
                                WHERE mst_books.author_id = mst_author.id
                            ) AS total_books
                FROM mst_author;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return <<

            DROP VIEW IF EXISTS `view_author_data`;
            SQL;
    }
};
