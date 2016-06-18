<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">
      Price <small>( <span ng-bind="chart.name"></span> )</small>
      <span style="float:right">
        <div class="btn-group">
          <button type="button" class="btn btn-default btn-xs" ng-click="chart.setType(3)">
            1m
          </button>
          <button type="button" class="btn btn-default btn-xs" ng-click="chart.setType(2)">
            1w
          </button>
          <button type="button" class="btn btn-default btn-xs" ng-click="chart.setType(1)">
            24h
          </button>
          <button type="button" class="btn btn-default btn-xs" ng-click="chart.setType(0)">
            1h
          </button>
        </div>
      </span>
    </h3>
  </div>
  <div class="panel-body">
    <canvas class="chart chart-line" chart-data="chart.data" chart-labels="chart.labels" style="height: 400px; width: 100%; text-align: center;">
    </canvas>
  </div>
</div>
