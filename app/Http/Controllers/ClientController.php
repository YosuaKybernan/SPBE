<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Aspect;
use App\Models\Article;
use App\Models\Material;
use App\Models\Regulation;
use Illuminate\Http\Request;
use App\Models\SelfAssessment;
use App\Models\FinalAssessment;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
        $slides = Slide::all();

        // Ambil Model dari SelfAssessment.php dan FinalAssessment.php
        $selfAssessments = SelfAssessment::all()->groupBy('year');
        $finalAssessments = FinalAssessment::all()->groupBy('year');

        $chartData = [];
        $iframeSrc = [];
        $averageData = [];

        foreach ($selfAssessments as $year => $assessments) {
            $firstDataset = [
                $assessments->first()->internal_policy,
                $assessments->first()->strategic_planning,
                $assessments->first()->information_technology,
                $assessments->first()->organizer,
                $assessments->first()->management_implementation,
                $assessments->first()->it_audit,
                $assessments->first()->administration_services,
                $assessments->first()->public_services,
            ];

            $secondDataset = [
                $finalAssessments[$year]->first()->internal_policy ?? 0,
                $finalAssessments[$year]->first()->strategic_planning ?? 0,
                $finalAssessments[$year]->first()->information_technology ?? 0,
                $finalAssessments[$year]->first()->organizer ?? 0,
                $finalAssessments[$year]->first()->management_implementation ?? 0,
                $finalAssessments[$year]->first()->it_audit ?? 0,
                $finalAssessments[$year]->first()->administration_services ?? 0,
                $finalAssessments[$year]->first()->public_services ?? 0,
            ];

            $chartData[$year] = [
                'firstDataset' => $firstDataset,
                'secondDataset' => $secondDataset,
            ];

            $iframeSrc[$year] = $finalAssessments[$year]->first()->excel_link ?? '';

            // Calculate the average for the final assessment
            $averageData[$year] = array_sum($secondDataset) / count($secondDataset);
        }

        return view('clients.content.home', compact('chartData', 'iframeSrc', 'slides', 'averageData'));
    }

    public function policy()
    {
        // Ambil data dari database
        $aspects = Aspect::with(['indicators.levels'])->whereHas('domain', function ($query) {
            $query->where('name', 'policy');
        })->get();

        return view('clients.content.policy', compact('aspects'));
    }

    public function governance()
    {
        $aspects = Aspect::with(['indicators.levels'])->whereHas('domain', function ($query) {
            $query->where('name', 'governance');
        })->get();

        return view('clients.content.governance', compact('aspects'));
    }

    public function management()
    {
        $aspects = Aspect::with(['indicators.levels'])->whereHas('domain', function ($query) {
            $query->where('name', 'management');
        })->get();

        return view('clients.content.management', compact('aspects'));
    }

    public function service()
    {
        $aspects = Aspect::with(['indicators.levels'])->whereHas('domain', function ($query) {
            $query->where('name', 'service');
        })->get();

        return view('clients.content.service', compact('aspects'));
    }

    public function article($id = null)
    {
        if (!is_null($id)) {
            $article = Article::findOrFail($id);
            return view('clients.content.article_detail', compact('article'));
        }

        $articles = Article::all();
        return view('clients.content.article', compact('articles'));
    }

    public function material()
    {
        $materials = Material::all();

        return view('clients.content.material', compact('materials'));
    }

    public function vis_mis()
    {
        return view('clients.content.vis_mis');
    }

    public function goals_obj()
    {
        return view('clients.content.goals_obj');
    }

    public function regulation()
    {
        $regulations = Regulation::all()->groupBy('category');

        return view('clients.content.regulation', compact('regulations'));
    }
}
