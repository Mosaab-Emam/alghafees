import { Post } from "@/types";
import ArticleBoxDetails from "./ArticleBoxDetails";
import ArticleAside from "./articleAside/ArticleAside";

export default function ArticleBox({
    post,
    latest_posts,
}: {
    post: Post;
    latest_posts: Array<Post>;
}) {
    return (
        <section className="flex lg:flex-row flex-col 2xl:gap-12 xl:gap-10 lg:gap-5 gap-8 xl:mb-[100px] lg:mb-8 mb-8">
            <ArticleBoxDetails post={post} />
            <ArticleAside latest_posts={latest_posts} />
        </section>
    );
}
