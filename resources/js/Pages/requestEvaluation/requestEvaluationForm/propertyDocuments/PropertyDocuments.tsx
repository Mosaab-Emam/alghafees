import React from "react";
import UploadFIleInput from "../../../joinUs/UploadFIleInput";

const PropertyDocuments = () => {
  return (
    <section className="w-full h-[661px] flex flex-col items-start gap-8">
      <UploadFIleInput
        radius="rounded-tl-[20px] rounded-br-[20px]"
        name="instrument_image"
        label="صورة الصك"
        placeholder="اختر من الملفات"
      />
      <UploadFIleInput
        radius="rounded-tl-[20px] rounded-br-[20px]"
        name="construction_license"
        label="رخصة البناء"
        placeholder="اختر من الملفات"
      />
      <UploadFIleInput
        radius="rounded-tl-[20px] rounded-br-[20px]"
        name="other_contracts"
        label=" مستندات اخرى"
        placeholder="اختر من الملفات"
      />
    </section>
  );
};

export default PropertyDocuments;
