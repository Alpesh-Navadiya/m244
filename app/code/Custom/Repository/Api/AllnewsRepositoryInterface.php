<?php
namespace Custom\Repository\Api;

interface AllnewsRepositoryInterface
{
	public function save(\Custom\Repository\Api\Data\AllnewsInterface $news);

    public function getById($newsId);

    public function delete(\Custom\Repository\Api\Data\AllnewsInterface $news);

    public function deleteById($newsId);
}
