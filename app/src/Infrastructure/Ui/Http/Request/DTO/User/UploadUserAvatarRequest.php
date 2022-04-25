<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Ui\Http\Request\DTO\User;

use Preventool\Infrastructure\Ui\Http\Request\RequestDTO;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class UploadUserAvatarRequest implements RequestDTO
{
    /**
     * @Assert\NotBlank
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"image/*"},
     *     mimeTypesMessage = "Please upload a valid Image"
     * )
     */
    private UploadedFile $avatar;

    public function __construct(Request $request)
    {
        $this->avatar = $request->files->get('avatar');
    }

    public function getAvatar(): UploadedFile
    {
        return $this->avatar;
    }

}