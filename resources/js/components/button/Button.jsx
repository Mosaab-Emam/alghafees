import "./Button.css";

const Button = ({
    variant = "primary",
    radius = "",
    className = "",
    onClick = () => {},
    disabled = false,
    children,
    type = "button",
}) => {
    return (
        <button
            type={type}
            onClick={onClick}
            disabled={disabled}
            className={`flex min-w-[150px] h-[50px] py-[15px] px-[44px] justify-center items-center gap-[10px] border-[2px] border-primary-600 text-primary-600 transition-all duration-200 ease-in-out
                ${
                    variant === "primary"
                        ? "bg-primary-600 text-white"
                        : "bg-white text-primary-600"
                }
                ${
                    radius === "right"
                        ? "rounded-tr-[50px] rounded-bl-[50px]"
                        : "rounded-tl-[50px] rounded-br-[50px]"
                }  ${className}`}
        >
            {children}
        </button>
    );
};

export default Button;
