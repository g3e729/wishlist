<?php

function authUserId()
{
	return auth()->user()->id ?? null;
}

function fileUpload()
{
	$file = request()->file;

	if (is_null($file)) {
		return null;
	}

	$fileName = time() . '.' . $file->extension();
	$file->move(public_path('uploads'), $fileName);
	
	return asset('uploads/' . $fileName);
}