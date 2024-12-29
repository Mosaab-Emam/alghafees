import React, { useState } from "react";

const ReqEvluaFormSelectInput = ({
  placeholder,
  label,
  name,
  query,
  value,
  onChange,
}) => {
  const { data, error, isLoading } = query();

  return (
    <div className="w-full flex flex-col items-start gap-[16px] self-stretch group relative">
      <label
        htmlFor={name}
        className="regular-b1 text-right text-Gray-scale-02 group-focus-within:text-primary-600 transition-colors duration-300"
      >
        {label}
      </label>

      <div className="relative w-full">
        <select
          id={name}
          name={name}
          value={value || ""}
          onChange={onChange}
          className={`w-full text-right appearance-none max-w-full sm:h-[48px] lg:h-[46px] xl:h-[48px]flex justify-end items-center rounded-tl-[20px] rounded-br-[20px] py-[13px] px-[16px] gap-[10px] bg-bg-02 border-[1px] border-transparent hover:border-primary-400 focus:border-primary-600 hover:bg-bg-01 focus:bg-bg-01 outline-none transition-all duration-300 ${
            value ? "text-primary-600" : "text-Gray-scale-02"
          }`}
        >
          <option value="" disabled>
            {placeholder}
          </option>
          {!isLoading &&
            data.data.map((option) => (
              <option key={option.id} value={option.id}>
                {option.title}
              </option>
            ))}
        </select>

        <svg
          className="absolute left-4 top-1/2 transform -translate-y-1/2 pointer-events-none "
          xmlns="http://www.w3.org/2000/svg"
          width="12"
          height="8"
          viewBox="0 0 12 8"
          fill="none"
        >
          <path
            d="M11 1L6 6L1 1"
            stroke="#0F819F"
            strokeWidth="2"
            strokeLinecap="round"
          />
        </svg>
      </div>
    </div>
  );
};

export default ReqEvluaFormSelectInput;
