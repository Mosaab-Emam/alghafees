import React from "react";

const ReqEvluaFormTextArea = ({
  placeholder,
  name,
  label,
  value,
  onChange,
}) => {
  return (
    <div className=" w-full flex flex-col items-start gap-[16px] self-stretch group">
      <label
        htmlFor={name}
        className="regular-b1 !text-base text-right text-Gray-scale-02 group-focus-within:text-primary-600 transition-colors duration-300"
      >
        {label}
      </label>
      <textarea
        id={name}
        name={name}
        value={value}
        onChange={onChange}
        placeholder={placeholder}
        className="resize-none w-full h-[150px] text-right max-w-full flex justify-end items-center py-[13px] px-[16px] gap-[10px] rounded-tl-[20px] rounded-br-[20px] bg-bg-02  border-[1px] border-transparent hover:border-primary-400 focus:border-primary-600 hover:bg-bg-01 focus:bg-bg-01 outline-none transition-all duration-300"
      />
    </div>
  );
};

export default ReqEvluaFormTextArea;
