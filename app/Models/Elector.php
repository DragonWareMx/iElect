<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Elector extends Model
{
    use HasFactory;
    public function job(){
        return $this->belongsTo('App\Models\Job');
    }
    public function section(){
        return $this->belongsTo('App\Models\Section');
    }
    public function campaign(){
        return $this->belongsTo('App\Models\Campaign');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //DATOS ENCRIPTADOS
    //GETS
    public function getNombreAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getApellidoPAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getApellidoMAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getEmailAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getSexoAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getTelefonoAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getEdoCivilAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getFechaNacAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getClaveElectorAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getColoniaAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getCalleAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getExtNumAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getIntNumAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getCpAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getLocalidadAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getMunicipioAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getFacebookAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getTwitterAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return 'Error';
        }
    }
    public function getCredencialAAttribute($value)
    {
        try {
            // in your Controller
            $encryptedContent = \Storage::get('public/files/'.$this->attributes['campaign_id'].'/'.$value.'.dat');
            $decryptedContent = decrypt($encryptedContent);
            return "data:image/png;base64,".base64_encode($decryptedContent);
        } catch (DecryptException $e) {
            return 'Error';
        }
        catch (\Exception $e) {
            return '';
        }
    }
    public function getCredencialRAttribute($value)
    {
        try {
            // in your Controller
            $encryptedContent = \Storage::get('public/files/'.$this->attributes['campaign_id'].'/'.$value.'.dat');
            $decryptedContent = decrypt($encryptedContent);
            return "data:image/png;base64,".base64_encode($decryptedContent);
        } catch (DecryptException $e) {
            return 'Error';
        }
        catch (\Exception $e) {
            return '';
        }
    }
    public function getFotoElectorAttribute($value)
    {
        try {
            // in your Controller
            $encryptedContent = \Storage::get('public/files/'.$this->attributes['campaign_id'].'/'.$value.'.dat');
            $decryptedContent = decrypt($encryptedContent);
            return "data:image/png;base64,".base64_encode($decryptedContent);
        } catch (DecryptException $e) {
            return 'Error';
        }
        catch (\Exception $e) {
            return '';
        }
    }
    public function getDocumentoAttribute($value)
    {
        try {
            // in your Controller
            $encryptedContent = \Storage::get('public/files/'.$this->attributes['campaign_id'].'/'.$value.'.dat');
            $decryptedContent = decrypt($encryptedContent);
            return "data:image/png;base64,".base64_encode($decryptedContent);
        } catch (DecryptException $e) {
            return 'Error';
        }
        catch (\Exception $e) {
            return '';
        }
    }

    //SETTER
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = Crypt::encryptString($value);
    }
    public function setApellidoPAttribute($value)
    {
        $this->attributes['apellido_p'] = Crypt::encryptString($value);
    }
    public function setApellidoMAttribute($value)
    {
        $this->attributes['apellido_m'] = Crypt::encryptString($value);
    }
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Crypt::encryptString($value);
    }
    public function setSexoAttribute($value)
    {
        $this->attributes['sexo'] = Crypt::encryptString($value);
    }
    public function setTelefonoAttribute($value)
    {
        $this->attributes['telefono'] = Crypt::encryptString($value);
    }
    public function setEdoCivilAttribute($value)
    {
        $this->attributes['edo_civil'] = Crypt::encryptString($value);
    }
    public function setFechaNacAttribute($value)
    {
        $this->attributes['fecha_nac'] = Crypt::encryptString($value);
    }
    public function setClaveElectorAttribute($value)
    {
        $this->attributes['clave_elector'] = Crypt::encryptString($value);
    }
    public function setColoniaAttribute($value)
    {
        $this->attributes['colonia'] = Crypt::encryptString($value);
    }
    public function setCalleAttribute($value)
    {
        $this->attributes['calle'] = Crypt::encryptString($value);
    }
    public function setExtNumAttribute($value)
    {
        $this->attributes['ext_num'] = Crypt::encryptString($value);
    }
    public function setIntNumAttribute($value)
    {
        $this->attributes['int_num'] = Crypt::encryptString($value);
    }
    public function setCpAttribute($value)
    {
        $this->attributes['cp'] = Crypt::encryptString($value);
    }
    public function setLocalidadAttribute($value)
    {
        $this->attributes['localidad'] = Crypt::encryptString($value);
    }
    public function setMunicipioAttribute($value)
    {
        $this->attributes['municipio'] = Crypt::encryptString($value);
    }
    public function setFacebookAttribute($value)
    {
        $this->attributes['facebook'] = Crypt::encryptString($value);
    }
    public function setTwitterAttribute($value)
    {
        $this->attributes['twitter'] = Crypt::encryptString($value);
    }
}
